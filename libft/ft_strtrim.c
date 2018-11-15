/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 12:12:17 by malallai          #+#    #+#             */
/*   Updated: 2018/11/15 16:03:59 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char			*ft_strtrim(char const *s)
{
	char	*new;
	int		i;
	int		j;

	if (!s)
		return (NULL);
	i = 0;
	j = ft_strlen(s) - 1;
	while (s[i] && ft_isspace(s[i]))
		i++;
	if (i == j + 1)
		i = 0;
	while (ft_isspace(s[j]))
		j--;
	new = ft_strsub(s, i, j - i + 1);
	return (new);
}
