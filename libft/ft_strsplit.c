/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 15:40:17 by malallai          #+#    #+#             */
/*   Updated: 2018/11/15 19:00:30 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static int		ft_countwords(char const *s, char c)
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

static size_t	ft_getwordsize(char const *s, char c)
{
	size_t	count;

	count = 0;
	while (*s && *s++ != c)
		count++;
	return (count);
}

static char		*ft_trimchar(char *s, char c)
{
	char	*new;
	int		i;
	int		j;

	if (!s)
		return (NULL);
	i = 0;
	j = ft_strlen(s) - 1;
	while (s[i] && s[i] == c)
		i++;
	if (i == j + 1)
		i = 0;
	while (s[j] == c)
		j--;
	new = ft_strsub(s, i, j - i + 1);
	return (new);
}

char			**ft_strsplit(char const *s, char c)
{
	char	**tab;
	int		index;
	char	*temp;
	int		i;

	if (!s)
		return (NULL);
	if (!(tab = malloc(sizeof(char *) * ft_countwords(s, c))))
		return (NULL);
	index = 0;
	temp = ft_trimchar(ft_strdup(s), c);
	while (index < ft_countwords(s, c))
	{
		i = 0;
		if (!(tab[index] = ft_strnew(ft_getwordsize(temp, c))))
			return (NULL);
		while (*temp && *temp != c)
			tab[index][i++] = *temp++;
		temp = ft_trimchar(ft_strdup(temp), c);
		tab[index++][i] = '\0';
	}
	tab[index] = NULL;
	return (tab);
}
