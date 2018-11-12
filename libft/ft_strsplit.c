/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 15:40:17 by malallai          #+#    #+#             */
/*   Updated: 2018/11/12 17:49:44 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		ft_countwords(char const *s, char c)
{
	int count;

	count = 0;
	while (*s)
	{
		if (*s == c)
			s++;
		else
		{
			count++;
			while (*s && *s != c)
				s++;
		}
	}
	return (count);
}

size_t	ft_getwordsize(char const *s, char c)
{
	size_t	count;

	count = 0;
	while (*s && *s++ != c)
		count++;
	return (count);
}

char	**ft_strsplit(char const *s, char c)
{
	char	**tab;
	int		index;
	int		words;
	char	*temp;
	int		i;

	words = ft_countwords(s, c);
	if (!(tab = malloc(sizeof(char *) * words)))
		return (NULL);
	index = 0;
	temp = (char *)s;
	while (index < words)
	{
		temp = ft_strtrim(temp);
		i = 0;
		if (!(tab[index] = ft_strnew(ft_getwordsize(temp, c))))
			return (NULL);
		while (*temp && *temp != c)
			tab[index][i++] = *temp++;
		tab[index++][i] = '\0';
	}
	tab[index] = NULL;
	return (tab);
}
